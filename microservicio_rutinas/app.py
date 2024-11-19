from flask import Flask, request, jsonify
from flask_cors import CORS
import pandas as pd
import json
from sklearn.tree import DecisionTreeClassifier
from sklearn.preprocessing import LabelEncoder

app = Flask(__name__)

# Configuración de CORS
CORS(app)

# Cargar el dataset
df = pd.read_csv('exercises.csv', encoding='latin1')

# Codificar las variables categóricas
le = LabelEncoder()
df['partecuerpo_encoded'] = le.fit_transform(df['partecuerpo'])
df['equipo_encoded'] = le.fit_transform(df['equipo'])

# Filtrar los datos según las condiciones dadas
def filtrar_rutinas(tipo_rutina, dias_semana, duracion, equipamiento, imc):
    # Filtrar por Tipo de Rutina
    if tipo_rutina == 'Cardio':
        df_filtered = df[df['partecuerpo'].str.contains('Cardio')]
    elif tipo_rutina == 'Fuerza':
        df_filtered = df[~df['partecuerpo'].str.contains('Cardio')]
    elif tipo_rutina == 'Flexibilidad':
        df_filtered = df[df['partecuerpo'].str.contains('Cintura')]

    # Filtrar por Equipamiento
    if equipamiento == 'Sin equipo':
        df_filtered = df_filtered[df_filtered['equipo'].str.contains('Peso corporal|cuerpo peso')]
    elif equipamiento == 'Equipo básico':
        df_filtered = df_filtered[df_filtered['equipo'].str.contains('Asistida|banda|Mancuerna|mancuerna|Banda de resistencia|Peso corporal|cuerpo peso')]
    elif equipamiento == 'Gimnasio completo':
        df_filtered = df_filtered

    # Determinar el número de ejercicios según la duración
    if duracion == '30 Minutos':
        num_ejercicios = 2
    elif duracion == '45 Minutos':
        num_ejercicios = 3
    elif duracion == '60 Minutos':
        num_ejercicios = 4
    elif duracion == '+60 Minutos':
        num_ejercicios = 5

    # Filtrar ejercicios según IMC
    imc = float(imc)
    if imc >= 25 and tipo_rutina == 'Fuerza':
        df_cardio = df[df['partecuerpo'].str.contains('Cardio')].sample(1)
        df_filtered = pd.concat([df_filtered.sample(num_ejercicios - 1), df_cardio])
    elif imc < 18.5 and tipo_rutina == 'Cardio':
        df_fuerza = df[~df['partecuerpo'].str.contains('Cardio')].sample(2)
        df_filtered = pd.concat([df_filtered.sample(num_ejercicios - 2), df_fuerza])
    else:
        df_filtered = df_filtered.sample(num_ejercicios)

    return df_filtered

# Generar el JSON con las rutinas
def formatear_rutina(tipo_rutina, dias_semana, duracion, equipamiento, imc):
    result = {}
    for dia in range(1, dias_semana + 1):
        recomendacion = filtrar_rutinas(tipo_rutina, dias_semana, duracion, equipamiento, imc)
        ejercicios = recomendacion['id sistema'].tolist()
        result[f'dia{dia}'] = ejercicios
    
    return result

# Ruta para generar rutinas
@app.route('/rutina', methods=['POST'])
def generar_rutina():
    # Recibimos los datos en formato JSON
    data = request.get_json()

    # Procesamos los datos del formulario
    nombre_rutina = data.get('nombre_rutina')
    tipo_rutina = data.get('tipo_rutina')
    dias_semana = int(data.get('dias'))
    duracion = data.get('duracion')
    equipo = data.get('equipo')
    imc = data.get('imc')

    # Generar la rutina
    rutina = formatear_rutina(tipo_rutina, dias_semana, duracion, equipo, imc)

    respuesta = {
        'nombre_rutina': nombre_rutina,
        'tipo_rutina': tipo_rutina,
        'dias': dias_semana,
        'duracion': duracion,
        'equipo': equipo,
        'rutina': rutina
    }

    return jsonify(respuesta), 200


# Get de prueba 
@app.route('/rutina', methods=['GET'])
def get_rutina():
    return jsonify({'message': 'Hola Mundo!'}), 200

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
