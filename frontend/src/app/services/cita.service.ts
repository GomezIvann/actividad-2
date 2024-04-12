import { Injectable } from '@angular/core';
import { API_BASE_URL } from '../common/constantes-api';
import { HttpClient } from '@angular/common/http';
import { RespuestaAPI, RespuestaAPIPaginada } from '../common/respuestas-api';
import { Cita } from '../interfaces/cita';
import { Observable } from 'rxjs';
import { Servicio } from '../interfaces/servicio';

@Injectable({
  providedIn: 'root',
})
export class CitaService {
  url = `${API_BASE_URL}citas`;

  constructor(private http: HttpClient) {}

  obtenerCitasUsuario(dni: string): Observable<RespuestaAPIPaginada<Cita[]>> {
    return this.http.get<RespuestaAPIPaginada<Cita[]>>(
      `${this.url}/usuario/${dni}`
    );
  }
  obtenerServiciosCita(idCita: number): Observable<RespuestaAPI<Servicio[]>> {
    return this.http.get<RespuestaAPI<Servicio[]>>(
      `${this.url}/${idCita}/servicios`
    );
  }
  reservarCita(cita: Cita) {
    return this.http.post<RespuestaAPI<Cita>>(this.url, cita);
  }
}
