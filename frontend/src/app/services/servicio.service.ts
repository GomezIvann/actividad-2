import { Injectable } from '@angular/core';
import { Servicio } from '../interfaces/servicio';
import { API_BASE_URL } from '../common/constantes-api';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { RespuestaApi } from '../common/respuesta-api';

@Injectable({
  providedIn: 'root',
})
export class ServicioService {
  url = `${API_BASE_URL}servicios`;

  constructor(private http: HttpClient) {}

  obtenerServicios(): Observable<RespuestaApi<Servicio[]>> {
    return this.http.get<RespuestaApi<Servicio[]>>(this.url);
  }
  obtenerServicioPorId(id: number): Observable<RespuestaApi<Servicio>> {
    return this.http.get<RespuestaApi<Servicio>>(`${this.url}/${id}`);
  }
}
