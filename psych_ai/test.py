from models.psych_health_model import PsychHealthModel
from utils.preprocess import tokenize_tweets
import torch

model = PsychHealthModel()
model.load_state_dict(torch.load("psych_health_model.pt"))
model.eval()

sample = ["I feel very stressed and anxious today"]
input_ids, attention_mask = tokenize_tweets(sample)
with torch.no_grad():
    output = model(input_ids, attention_mask)
print("Predicted scores:", output[0].numpy())