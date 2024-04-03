import { Injectable } from '@angular/core';
import { Tienda } from '../interfaces/tienda';

@Injectable({
  providedIn: 'root',
})
export class TiendaService {
  tiendas: Tienda[] = [
    {
      id: 1,
      horario: '10:00 - 22:00',
      direccion: 'Calle Málaga, 24, Valencia',
      telefono: '123456789',
      capacidad: 50,
      estado: 'abierta',
      imagen: 'https://i.ibb.co/Rh5vt4z/tienda-1.webp',
    },
    {
      id: 2,
      horario: '9:00 - 20:00',
      direccion: 'Calle Colón, 3, Valencia',
      telefono: '123456789',
      capacidad: 50,
      estado: 'abierta',
      imagen: 'https://i.ibb.co/W5TDtWg/tienda-2.jpg',
    },
    {
      id: 3,
      horario: '8:00 - 20:00',
      direccion: 'Calle General Elio, 42, Valencia',
      telefono: '123456789',
      capacidad: 50,
      estado: 'abierta',
      imagen: 'https://i.ibb.co/L0Dgs19/tienda-3.jpg',
    },
    {
      id: 4,
      horario: '9:00 - 20:00',
      direccion: 'Calle San Vicente, 12, Valencia',
      telefono: '123456789',
      capacidad: 50,
      estado: 'abierta',
      imagen: 'https://i.ibb.co/qC86vJG/tienda-4.webp',
    },
  ];

  constructor() {}

  obtenerTiendas() {
    return this.tiendas;
  }
  obtenerTiendaPorId(id: number) {
    return this.tiendas.find((tienda) => tienda.id === id);
  }
}
