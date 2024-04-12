import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { RespuestaAPI, RespuestaAPIPaginada } from '../common/respuestas-api';
import { API_BASE_URL } from '../common/constantes-api';
import { Empleado } from '../interfaces/empleado';

@Injectable({
  providedIn: 'root',
})
export class EmpleadoService {
  url = `${API_BASE_URL}empleados`;

  constructor(private http: HttpClient) {}

  obtenerEmpleados(): Observable<RespuestaAPIPaginada<Empleado[]>> {
    return this.http.get<RespuestaAPIPaginada<Empleado[]>>(this.url);
  }
  obtenerEmpleadoPorId(id: number): Observable<RespuestaAPI<Empleado>> {
    return this.http.get<RespuestaAPI<Empleado>>(`${this.url}/${id}`);
  }
}
