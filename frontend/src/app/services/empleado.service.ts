import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { RespuestaApi } from '../common/respuesta-api';
import { API_BASE_URL } from '../common/constantes-api';
import { Empleado } from '../interfaces/empleado';

@Injectable({
  providedIn: 'root',
})
export class EmpleadoService {
  url = `${API_BASE_URL}empleados`;

  constructor(private http: HttpClient) {}

  obtenerEmpleados(): Observable<RespuestaApi<Empleado[]>> {
    return this.http.get<RespuestaApi<Empleado[]>>(this.url);
  }
  obtenerEmpleadoPorId(id: number): Observable<RespuestaApi<Empleado>> {
    return this.http.get<RespuestaApi<Empleado>>(`${this.url}/${id}`);
  }
}
