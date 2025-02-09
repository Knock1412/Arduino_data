import serial

try:
    ser = serial.Serial('COM8', 9600, timeout=1)  # Remplace COMX par ton port
    print(f"Connexion réussie sur {ser.port}")
    ser.close()
except serial.SerialException as e:
    print(f"Erreur d'ouverture du port : {e}")
