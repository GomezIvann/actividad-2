import { Servicio } from './servicio';
import { Tienda } from './tienda';

export interface Empleado {
  id: number;
  nombre: string;
  apellidos: string;
  ciudad: string;
  pais: string;
  imagen: string;
  servicios: Servicio[];
  id_tienda: number;
  red_social: string;
}
