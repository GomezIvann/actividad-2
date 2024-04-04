import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { InicioTarjetaComponent } from '../inicio-tarjeta/inicio-tarjeta.component';

@Component({
  selector: 'app-inicio',
  standalone: true,
  imports: [RouterLink, InicioTarjetaComponent],
  templateUrl: './inicio.component.html',
  styleUrl: './inicio.component.css'
})
export class InicioComponent {}
