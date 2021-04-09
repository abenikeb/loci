from flask import Flask, render_template, request
import pickle
import numpy as np

model = pickle.load(open('model_AI.pkl', 'rb'))

app = Flask(__name__)


@app.route('/')
def hello_world():
    return ("Hello! This is loci company-")


@app.route('/predict_master', methods=['POST'])
def predict():
    int_features = [float(x) for x in request.form.values()]
    final = [np.array(int_features)]
#     print(int_features)
#     print(final)
#     test = np.array([41.2, 11.5, 1, 11.2, 23.5, 45, 10, 4, 23])
#     test = test.reshape(1, -1)
    prediction = model.predict(final)
   
    if prediction > (0.5):
       return render_template('index.php', pred=prediction)

    else:
        return render_template('index.php', pred=prediction)


if __name__ == "__main__":
    app.run(debug=True)
