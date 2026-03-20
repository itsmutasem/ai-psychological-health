from fastapi import FastAPI
from pydantic import BaseModel
import torch
from models.psych_health_model import PsychHealthModel
from utils.preprocess import tokenize_tweets

app = FastAPI()

# --- Load the trained model ---
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
model = PsychHealthModel()
model.load_state_dict(torch.load("psych_health_model.pt", map_location=device))
model.to(device)
model.eval()


# --- Request model ---
class TweetsRequest(BaseModel):
    tweets: list[str]  # list of tweet strings


@app.post("/predict")
def predict(data: TweetsRequest):
    # Tokenize all tweets into one text
    text = " ".join(data.tweets)
    input_ids, attention_mask = tokenize_tweets([text])
    input_ids, attention_mask = input_ids.to(device), attention_mask.to(device)

    with torch.no_grad():
        output = model(input_ids, attention_mask)

    # Convert output to list
    return {
        "health_index": float(output[0][0]),
        "depression_risk": float(output[0][1]),
        "anxiety_risk": float(output[0][2]),
        "stress_level": float(output[0][3]),
        "social_isolation": float(output[0][4]),
        "self_esteem_issues": float(output[0][5]),
        "emotional_instability": float(output[0][6]),
    }