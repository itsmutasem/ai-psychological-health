# 🧠 AI Psychological Health Analyzer

A full-stack application that analyzes a user’s recent tweets to estimate psychological health metrics such as **depression, anxiety, and stress** using a fine-tuned NLP model.

---

## 🚀 Overview

This project combines **Laravel (Backend)** and **Python (AI Model)** to build a real-world system that:

* Fetches tweets using the Twitter API
* Processes text using a trained BERT model
* Predicts psychological metrics
* Displays results in a modern dashboard

---

## 🏗️ Architecture

```
User Input (Twitter Username)
        ↓
Laravel Backend
        ↓
Twitter API (Fetch Tweets)
        ↓
Python API (FastAPI)
        ↓
BERT Model (Prediction)
        ↓
Laravel View (Dashboard)
```

---

## ✨ Features

* 🔍 Analyze real tweets
* 🧠 AI-based psychological predictions
* 📊 Metrics:

  * Depression Risk
  * Anxiety Risk
  * Stress Level
* ⚡ Real-time API integration
* 🎨 Modern UI with Tailwind CSS + Alpine.js

---

## 🧰 Tech Stack

### Backend

* Laravel
* PHP
* HTTP Client (API calls)

### AI / Machine Learning

* Python
* PyTorch
* Transformers (BERT)
* FastAPI

### Frontend

* Blade (Laravel)
* Tailwind CSS
* Alpine.js

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/psych-ai.git
cd psych-ai
```

### 2. Setup Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Add your Twitter Bearer Token:

```
TWITTER_BEARER_TOKEN=your_token_here
```

Run server:

```bash
php artisan serve
```

---

### 3. Setup Python AI API

```bash
cd psych_ai
python -m venv venv
source venv/bin/activate   # or venv\Scripts\activate on Windows
pip install -r requirements.txt
python train.py
```

Run API:

```bash
uvicorn main:app --reload
```

---

## 🤖 Model Details

* Base Model: `bert-base-uncased`
* Task: Multi-output regression
* Inputs: Tweets text
* Outputs:

  * Depression score
  * Anxiety score
  * Stress score

The model is trained on **labeled psychological datasets** and predicts scores based on linguistic patterns.

---

## 📡 API Usage

### Endpoint

```
POST /predict
```

### Request

```json
{
  "tweets": ["I feel tired", "Life is great"]
}
```

### Response

```json
{
  "depression": 4.3,
  "anxiety": 3.8,
  "stress": 5.1
}
```

---

## 📊 Example Output

* Depression Risk: 4.34%
* Anxiety Risk: 4.36%
* Stress Level: 6.14%

> ⚠️ Note: These values are **AI predictions** and not medical diagnoses.

---

## 🔐 Ethics & Disclaimer

This project is for **educational and research purposes only**.

* Not a medical tool
* Not a substitute for professional diagnosis
* Requires user consent if used with real data

---

## 📈 Future Improvements

* Add more metrics (self-esteem, emotional stability)
* Improve dataset quality
* Add user history tracking
* Visualization charts (graphs, trends)
* Deploy model to cloud (AWS / Docker)

---

## 👨‍💻 Author

**Mutasem Mustafa** | Software Engineer

**Ruaa Sami** | AI Engineer


---

## ⭐ Contributing

Contributions are welcome!

1. Fork the repo
2. Create a feature branch
3. Commit your changes
4. Open a pull request

---

## 📜 License

This project is open-source and available under the MIT License.
