import { Injectable } from '@angular/core';
import { Servicio } from '../interfaces/servicio';

@Injectable({
  providedIn: 'root',
})
export class ServicioService {
  servicios: Servicio[] = [
    {
      id: 1,
      nombre: 'Corte de cabello',
      descripcion:
        'Nos ajustamos a tus necesidades y estilo personal para ofrecer un servicio exclusivo acorde a lo que buscas. Te asesoramos  teniendo en cuenta tus gustos y las tendencias actuales.',
      precio: 12,
    },
    {
      id: 2,
      nombre: 'Afeitado',
      descripcion:
        'Sácale el mayor partido a tu barba. Con nuestros diseños pretendemos arreglar tu barba delimitando los contornos a través de un afeitado tradicional, además de recomendarte su correcto mantenimiento en casa.',
      precio: 6,
    },
    {
      id: 3,
      nombre: 'Técnicas',
      descripcion:
        'Aplicamos nuestras técnicas de corte para todas las edades, gustos y estilos. Realizamos nuestro afeitado tradicional a la navaja con toalla caliente y fría, trabajos de mechas y color, matizado de canas según el color de tu barba, y muchos más.',
      precio: 15,
    },
    {
      id: 4,
      nombre: 'Tratamientos',
      descripcion:
        'Los mejores cuidados para un increíble acabado. Una amplia gama de tratamientos para el cabello, barba y piel.',
      precio: 10,
    },
  ];

  constructor() {}

  obtenerServicios() {
    return this.servicios;
  }

  obtenerServicioPorId(id: number) {
    return this.servicios.find((servicio) => servicio.id === id);
  }
}
