import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { RespuestaApi } from '../common/respuesta-api';
import { API_BASE_URL } from '../common/constantes-api';
import { Empleado } from '../interfaces/empleado';

@Injectable({
  providedIn: 'root',
})
export class EmpleadoService {
  url = `${API_BASE_URL}empleados`;

  mockEmpleados: Empleado[] = [
    {
      id: 1,
      nombre: 'Juan',
      apellidos: 'Perez Perez',
      imagen: 'https://via.placeholder.com/150',
    },
    {
      id: 2,
      nombre: 'Pedro',
      apellidos: 'Gomez Gomez',
      imagen: 'https://via.placeholder.com/150',
    },
    {
      id: 3,
      nombre: 'Luis',
      apellidos: 'Gonzalez Gonzalez',
      imagen: 'https://via.placeholder.com/150',
    },
  ];

  constructor(private http: HttpClient) {}

  obtenerEmpleados(): Observable<RespuestaApi<Empleado[]>> {
    // return this.http.get<RespuestaApi<Empleado[]>>(this.url);
    return of({
      status: 'success',
      message: 'Empleados obtenidos correctamente',
      data: this.mockEmpleados,
    });
  }
  obtenerEmpleadoPorId(id: number): Observable<RespuestaApi<Empleado>> {
    return this.http.get<RespuestaApi<Empleado>>(`${this.url}/${id}`);
  }
  // obtenerEmpleadosPorServicio(servicioId: number): Observable<RespuestaApi<Empleado[]>> {

  // }
}
