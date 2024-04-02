import { Injectable } from '@angular/core';
import { Tienda } from '../interfaces/tienda';

@Injectable({
  providedIn: 'root',
})
export class TiendaService {
  tiendas: Tienda[] = [
    { id: 1, location: 'Calle 1', city: 'Valencia', status: 'open' },
    { id: 2, location: 'Calle 2', city: 'Valencia', status: 'closed' },
    { id: 3, location: 'Calle 3', city: 'Valencia', status: 'open' },
    { id: 4, location: 'Calle 4', city: 'Valencia', status: 'closed' },
    { id: 5, location: 'Calle 5', city: 'Valencia', status: 'open' },
  ];

  constructor() {}

  obtenerTiendas() {
    return this.tiendas;
  }
  obtenerTiendaPorId(id: number) {
    return this.tiendas.find((tienda) => tienda.id === id);
  }
}
