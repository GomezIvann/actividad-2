import { Component, Input } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-tarjeta-inicio',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './tarjeta-inicio.component.html',
  styleUrl: './tarjeta-inicio.component.css',
})
export class TarjetaInicioComponent {
  @Input() titulo: string = '';
  @Input() descripcion: string = '';
  @Input() ruta: string = '';
  @Input() color: string = '';
}
