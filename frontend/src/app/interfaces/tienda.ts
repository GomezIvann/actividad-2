export interface Tienda {
  id: number;
  horario: string;
  direccion: string;
  telefono: string;
  capacidad: number;
  estado: 'abierta' | 'cerrada' | 'reformas';
  imagen: string;
}
