import { Servicio } from './servicio';
import { Tienda } from './tienda';

export interface Empleado {
  id: number;
  id_tienda: number;
  nombre: string;
  apellidos: string;
  ciudad: string;
  pais: string;
  imagen: string;
  red_social: string;
  
  servicios?: Servicio[];
  tienda?: Tienda;
}
