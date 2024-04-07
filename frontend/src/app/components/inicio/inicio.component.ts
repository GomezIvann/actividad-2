import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { TarjetaInicioComponent } from '../tarjeta-inicio/tarjeta-inicio.component';

@Component({
  selector: 'app-inicio',
  standalone: true,
  imports: [RouterLink, TarjetaInicioComponent],
  templateUrl: './inicio.component.html',
  styleUrl: './inicio.component.css',
})
export class InicioComponent {}
