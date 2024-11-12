from threading import Thread, Semaphore
import time

# Crear semáforos
semaforo_direccion = Semaphore(1)      # Controla el cambio de dirección
semaforo_vehiculos = Semaphore(3)      # Limita a 3 vehículos en el puente
contador_direccion = Semaphore(1)      # Controla la alternancia de direcciones

# Variables globales
direccion_actual = "norte"
ciclo_actual = 0

# Función para que los vehículos crucen el puente
def cruzar_puente(id_vehiculo, direccion):
    print(f"Vehículo {id_vehiculo} en dirección {direccion} está esperando para cruzar.")
    semaforo_vehiculos.acquire()  # Intentar entrar al puente
    print(f"Vehículo {id_vehiculo} en dirección {direccion} está cruzando el puente.")
    time.sleep(1)  # Simulamos el tiempo que tarda en cruzar el puente
    print(f"Vehículo {id_vehiculo} en dirección {direccion} ha cruzado el puente.")
    semaforo_vehiculos.release()  # Salir del puente

# Función para gestionar los ciclos de tráfico en ambas direcciones
def gestionar_direccion():
    global direccion_actual, ciclo_actual
    
    for ciclo in range(5):  # 5 ciclos de paso alternado
        with semaforo_direccion:
            direccion_actual = "norte" if ciclo % 2 == 0 else "sur"
            print(f"\n--- Comienza el paso de vehículos hacia el {direccion_actual} ---")
            
            # Crear y lanzar hilos para vehículos en la dirección actual
            hilos = []
            for i in range(3):  # 3 vehículos por dirección
                id_vehiculo = f"{direccion_actual}_{ciclo * 3 + i + 1}"
                hilo = Thread(target=cruzar_puente, args=(id_vehiculo, direccion_actual))
                hilos.append(hilo)
                hilo.start()

            # Esperar a que todos los vehículos en esta dirección crucen
            for hilo in hilos:
                hilo.join()
            
            print(f"--- Todos los vehículos en dirección {direccion_actual} han cruzado ---\n")
            time.sleep(1)  # Pausa entre cambios de dirección

# Ejecutar la gestión de tráfico
gestionar_direccion()
print("Todos los ciclos de tráfico en el puente han terminado.")
