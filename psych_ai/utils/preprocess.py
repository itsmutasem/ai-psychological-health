from transformers import AutoTokenizer
import torch

tokenizer = AutoTokenizer.from_pretrained("bert-base-uncased")


def tokenize_tweets(tweets, max_length=64):
    """
    Convert list of strings to token ids and attention masks
    """
    encoding = tokenizer(
        tweets,
        padding='max_length',  # ensures all sequences have same length
        truncation=True,
        max_length=max_length,
        return_tensors="pt"
    )
    return encoding['input_ids'], encoding['attention_mask']


# --- New collate function ---
def collate_batch(batch):
    input_ids_list, attention_mask_list, labels_list = [], [], []
    for input_ids, attention_mask, label in batch:
        input_ids_list.append(input_ids)
        attention_mask_list.append(attention_mask)
        labels_list.append(label)

    # pad sequences to max length in batch
    input_ids = torch.nn.utils.rnn.pad_sequence(input_ids_list, batch_first=True, padding_value=tokenizer.pad_token_id)
    attention_mask = torch.nn.utils.rnn.pad_sequence(attention_mask_list, batch_first=True, padding_value=0)
    labels = torch.stack(labels_list)
    return input_ids, attention_mask, labels