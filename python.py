import matplotlib.pyplot as plt
import numpy as np

# Datos iniciales
# anchos_de_bobinas = [1880, 1800, 1700, 1600, 1500, 1450, 1400, 900, 800, 700, 500, 200]  # Anchuras de las bobinas disponibles
anchos_de_bobinas = [
    1880, 1850, 1830, 1800, 1780, 1750, 1730, 1700, 1680, 1650,
    1630, 1600, 1580, 1550, 1530, 1500, 1480, 1450, 1430, 1400,
    1380, 1350, 1330, 1300, 1280, 1250, 1230, 1200, 1180, 1150,
    1130, 1100, 1080, 1050, 1030, 1000, 980, 950, 930, 900,
    880, 850, 830, 800, 780, 750, 730, 700, 600, 50
]

cuchillas = [1, 2, 3, 4, 5]  # Cuchillas disponibles
pedido = 1700  # Ancho de cada pieza
ajuste_adicional = 40  # Ajuste de -40 mm

# Función para calcular la mejor bobina
def calcular_mejor_bobina(pedido, anchos_de_bobinas, cuchillas):
    mejor_bobina = None
    max_piezas = 0
    desperdicio_minimo = np.inf
    
    anchos_de_bobinas.sort()  # Ordenar las bobinas de menor a mayor
    
    for ancho in anchos_de_bobinas:
        if ancho > pedido:
            for cuchilla in cuchillas:
                piezas = ancho // pedido
                if piezas >= cuchilla:
                    ancho_utilizado = piezas * pedido
                    desperdicio = ancho - ancho_utilizado
                    
                    if piezas >= 1 and desperdicio < desperdicio_minimo:
                        mejor_bobina = ancho
                        max_piezas = piezas
                        desperdicio_minimo = desperdicio
                        
    return {
        "ancho_bobina": mejor_bobina,
        "piezas_que_caben": max_piezas,
        "total_ancho_utilizado": max_piezas * pedido,
        "desperdicio": desperdicio_minimo
    }

# Resultado del cálculo
resultado = calcular_mejor_bobina(pedido, anchos_de_bobinas, cuchillas)

# Verificar si hay una bobina seleccionada y proceder con los cálculos
if resultado["ancho_bobina"]:
    restado = resultado["ancho_bobina"] - ajuste_adicional
    print(f"Para un pedido de {pedido} mm, necesitas una bobina de {resultado['ancho_bobina']} mm")
    print(f"Quitado - 40 mm: {restado} mm")
    print(f"Total de ancho utilizado: {restado} mm")
    
    if restado > 0:
        cuatro = restado / 4
        desperdicio_real = restado - (cuatro * 4)
        print(f"Para 4 piezas iguales: Posición de cuchilla: {cuatro:.2f} mm")
        print(f"Desperdicio de open: {desperdicio_real:.2f} mm")
        
        tres = float(restado) / 3
        desperdicio_real2 = restado - (tres * 3)
        print(f"Para 3 piezas iguales: Posición de cuchilla: {tres:.2f} mm")
        print(f"Desperdicio de open: {desperdicio_real2:.2f} mm")

        
        dos = restado / 2
        desperdicio_real3 = restado - (dos * 2)
        print(f"Para 2 piezas iguales: Posición de cuchilla: {dos:.2f} mm")
        print(f"Desperdicio de open: {desperdicio_real3:.2f} mm")
        
        piezasmalas = int(restado // cuatro)
        print(f"Desperdicio real: {desperdicio_real:.2f} mm")
        desperdicio_real4 = restado - (piezasmalas * 4)
        print(f"Desperdicio real ajustado: {desperdicio_real4:.2f} mm")
    else:
        print("Estado de la combinación: Mala")
else:
    print("No hay una bobina disponible que cumpla los requisitos.")

# Graficar cómo se cortan las piezas y las posiciones de las cuchillas
if resultado["ancho_bobina"]:
    fig, ax = plt.subplots(figsize=(10, 2))
    
    # Dibujar la bobina completa (recomendada) detrás
    ax.add_patch(plt.Rectangle((0, 0), resultado["ancho_bobina"], 1, edgecolor='black', facecolor='lightgray', label="Bobina Recomendada"))
 
    # Dibujar las piezas cortadas y posiciones de las cuchillas para 4 piezas
for i in range(4):
    posicion_cuchilla = i * cuatro
    ax.add_patch(plt.Rectangle((posicion_cuchilla, 0), cuatro, 1, edgecolor='black', facecolor='skyblue', label="4 Piezas Cortadas" if i == 0 else ""))
    ax.axvline(x=posicion_cuchilla, color='blue', linestyle='-')  # Marcar posición de la cuchilla
    ax.text(posicion_cuchilla + cuatro / 2 - 10, 0.6, f'{cuatro:.2f}', color='red', fontsize=12)

# Dibujar las piezas cortadas y posiciones de las cuchillas para 3 piezas (debajo)
for i in range(3):
    posicion_cuchilla3 = i * tres
    ax.add_patch(plt.Rectangle((posicion_cuchilla3, -1), tres, 1, edgecolor='black', facecolor='lightgreen', label="3 Piezas Cortadas" if i == 0 else ""))
    ax.axvline(x=posicion_cuchilla3, color='green', linestyle='-')
    ax.text(posicion_cuchilla3 + tres / 2 - 10, -0.4, f'{tres:.2f}', color='red', fontsize=12)

# Dibujar las piezas cortadas y posiciones de las cuchillas para 2 piezas (debajo)
for i in range(2):
    posicion_cuchilla2 = i * dos
    ax.add_patch(plt.Rectangle((posicion_cuchilla2, -2), dos, 1, edgecolor='black', facecolor='yellow', label="2 Piezas Cortadas" if i == 0 else ""))
    ax.axvline(x=posicion_cuchilla2, color='orange', linestyle='-')
    ax.text(posicion_cuchilla2 + dos / 2 - 10, -0.2, f'{dos:.2f}', color='red', fontsize=12)


    # # Dibujar el desperdicio (si hay)
    if resultado["desperdicio"] > 0:
        ax.add_patch(plt.Rectangle((resultado["piezas_que_caben"] * pedido, 0), resultado["desperdicio"], 1, edgecolor='black', facecolor='red', label="Desperdicio"))

   
    
# 

    # Ajustar límites y título
    ax.set_xlim(0, resultado["ancho_bobina"])
    ax.set_ylim(-2.5, 1.5)
    ax.set_title(f'Bobina recomendada {resultado["ancho_bobina"]}  -40mm = {resultado["ancho_bobina"]-40}mm')
    
    ax.set_axis_off()

    # Mostrar leyenda correctamente
    handles, labels = ax.get_legend_handles_labels()
    unique_labels = dict(zip(labels, handles))  # Filtrar etiquetas duplicadas
    ax.legend(unique_labels.values(), unique_labels.keys())
    # ax.set_title(f'Bobina de {resultado["ancho_bobina"]} mm - Ajustada (-40 mm)')


    plt.show()
