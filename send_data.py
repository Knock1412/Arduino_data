import serial
import requests
import time
import re  # Importer le module pour gérer les expressions régulières

# Configuration du port série
try:
    ser = serial.Serial('COM8', 9600, timeout=1)
    time.sleep(2)  # Attendre la connexion avec l'Arduino
    print("✅ Connexion série établie.")
except serial.SerialException as e:
    print(f"❌ Erreur de connexion au port série : {e}")
    exit()

URL = "http://localhost/TEST/insert_data.php"

while True:
    try:
        if ser.in_waiting > 0:
            raw_data = ser.readline().decode('utf-8', errors='ignore').strip()  # Lire et nettoyer la donnée
            
            if raw_data:  # Vérifier que ce n'est pas une ligne vide
                print(f"📥 Donnée brute reçue : '{raw_data}'")  # Afficher ce que Python reçoit
                
                # Extraire uniquement les chiffres de la chaîne (entiers ou décimaux)
                match = re.search(r'\d+(\.\d+)?', raw_data)  # Recherche un nombre entier ou décimal
                
                if match:
                    distance = float(match.group())  # Convertir en nombre
                    print(f"📏 Distance valide : {distance} cm")

                    response = requests.post(URL, data={'distance': distance}, timeout=5)

                    if response.status_code == 200:
                        print(f"✅ Donnée envoyée avec succès : {response.text}")
                    else:
                        print(f"⚠️ Erreur HTTP ({response.status_code}) : {response.text}")
                else:
                    print("⚠️ Aucune valeur numérique détectée, donnée ignorée.")
            else:
                print("⚠️ Ligne vide reçue, ignorée.")

    except requests.RequestException as e:
        print(f"❌ Erreur HTTP : {e}")
    except serial.SerialException as e:
        print(f"❌ Erreur de communication série : {e}")
    except Exception as e:
        print(f"❌ Erreur inattendue : {e}")

    time.sleep(1)  # Pause avant la prochaine lecture
