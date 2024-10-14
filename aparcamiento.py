import threading
import time
from random import randint

# Constantes
E = 2  # Número de barreras de entrada
S = 2  # Número de barreras de salida
N = 10  # Capacidad del aparcamiento
TIEMPO_EJECUCION = 20  # Tiempo total en segundos para que se detenga el programa

# Variables compartidas
plazas_disponibles = N
lock = threading.Lock()  # Para sincronizar el acceso a las plazas
semaforo_plazas = threading.Semaphore(N)  # Semáforo para limitar el acceso según plazas disponibles
salida_event = threading.Event()  # Evento para señalizar la finalización

# Funciones para simular las barreras
def esperar_llegada(i):
    """Simula la espera de un coche en la barrera i."""
    time.sleep(randint(1, 3))  # Simula tiempo de llegada aleatorio
    print(f"Llegada de coche en la barrera {i}")

def elevar_barrera(i):
    """Simula el levantamiento de la barrera i."""
    print(f"Barrera {i} elevada - Coche pasando...")
    time.sleep(1)  # Tiempo que tarda en pasar el coche
    print(f"Barrera {i} bajada - Coche pasó.")

def entrada(i):
    global plazas_disponibles
    while not salida_event.is_set():
        esperar_llegada(i)
        if semaforo_plazas.acquire(timeout=1):  # Intenta adquirir el semáforo, si no hay plazas espera
            with lock:
                plazas_disponibles -= 1
                print(f"Entrada {i}: coche entra. Plazas disponibles: {plazas_disponibles}")
            elevar_barrera(i)
        else:
            print(f"Entrada {i}: aparcamiento lleno. Esperando...")
        time.sleep(1)

def salida(i):
    global plazas_disponibles
    while not salida_event.is_set():
        esperar_llegada(i)
        with lock:
            plazas_disponibles += 1
            print(f"Salida {i}: coche sale. Plazas disponibles: {plazas_disponibles}")
            semaforo_plazas.release()  # Libera una plaza en el semáforo
        elevar_barrera(i)
        time.sleep(1)

# Crear hilos para cada barrera de entrada
for i in range(E):
    hilo_entrada = threading.Thread(target=entrada, args=(i,))
    hilo_entrada.start()

# Crear hilos para cada barrera de salida
for i in range(E, E + S):
    hilo_salida = threading.Thread(target=salida, args=(i,))
    hilo_salida.start()

# Temporizador para detener el programa después de TIEMPO_EJECUCION segundos
time.sleep(TIEMPO_EJECUCION)
salida_event.set()
