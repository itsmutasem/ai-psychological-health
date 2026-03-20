import torch
import torch.nn as nn
from transformers import AutoModel

class PsychHealthModel(nn.Module):
    def __init__(self, output_size=7):
        """
        output_size: number of metrics to predict
        """
        super().__init__()
        self.bert = AutoModel.from_pretrained("bert-base-uncased")
        self.fc = nn.Linear(768, output_size)  # 768 = hidden size of BERT

    def forward(self, input_ids, attention_mask):
        outputs = self.bert(input_ids=input_ids, attention_mask=attention_mask)
        cls_embedding = outputs.last_hidden_state[:, 0, :]  # CLS token
        return self.fc(cls_embedding)