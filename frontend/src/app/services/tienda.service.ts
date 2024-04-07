import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { RespuestaApi } from '../common/respuesta-api';
import { Tienda } from '../interfaces/tienda';
import { API_BASE_URL } from '../common/constantes-api';

@Injectable({
  providedIn: 'root',
})
export class TiendaService {
  url = `${API_BASE_URL}tiendas`;

  constructor(private http: HttpClient) {}

  obtenerTiendas(): Observable<RespuestaApi<Tienda[]>> {
    return this.http.get<RespuestaApi<Tienda[]>>(this.url);
  }
  obtenerTiendaPorId(id: number): Observable<RespuestaApi<Tienda>> {
    return this.http.get<RespuestaApi<Tienda>>(`${this.url}/${id}`);
  }
}
