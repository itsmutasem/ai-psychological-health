import pandas as pd
import torch
from torch.utils.data import Dataset, DataLoader
import torch.nn as nn
from torch.optim import Adam
from models.psych_health_model import PsychHealthModel
from utils.preprocess import tokenize_tweets, collate_batch

# --- Step 1: Load dataset ---
df = pd.read_csv("data/synthetic_psych_dataset.csv")

# --- Step 2: Custom Dataset ---
class TweetsDataset(Dataset):
    def __init__(self, df):
        self.tweets = df['tweets'].tolist()
        self.labels = df[['health_index', 'depression_risk', 'anxiety_risk',
                          'stress_level', 'social_isolation',
                          'self_esteem_issues', 'emotional_instability']].values.astype(float)

    def __len__(self):
        return len(self.tweets)

    def __getitem__(self, idx):
        tweet = self.tweets[idx].split(' ||| ')
        text = " ".join(tweet)
        input_ids, attention_mask = tokenize_tweets([text])
        label = torch.tensor(self.labels[idx], dtype=torch.float)
        return input_ids.squeeze(0), attention_mask.squeeze(0), label

dataset = TweetsDataset(df)
dataloader = DataLoader(dataset, batch_size=8, shuffle=True, collate_fn=collate_batch)

# --- Step 3: Model ---
model = PsychHealthModel()
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
model.to(device)

# --- Step 4: Loss & Optimizer ---
criterion = nn.MSELoss()
optimizer = Adam(model.parameters(), lr=1e-5)

# --- Step 5: Training Loop ---
epochs = 3
for epoch in range(epochs):
    model.train()
    total_loss = 0
    for input_ids, attention_mask, labels in dataloader:
        input_ids, attention_mask, labels = input_ids.to(device), attention_mask.to(device), labels.to(device)
        optimizer.zero_grad()
        outputs = model(input_ids, attention_mask)
        loss = criterion(outputs, labels)
        loss.backward()
        optimizer.step()
        total_loss += loss.item()
    print(f"Epoch {epoch+1}/{epochs}, Loss: {total_loss/len(dataloader):.4f}")

# --- Step 6: Save model ---
torch.save(model.state_dict(), "psych_health_model.pt")
print("Model trained and saved.")