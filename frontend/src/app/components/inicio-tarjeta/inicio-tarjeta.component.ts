import { Component, Input } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-inicio-tarjeta',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './inicio-tarjeta.component.html',
  styleUrl: './inicio-tarjeta.component.css'
})
export class InicioTarjetaComponent {
  @Input() titulo: string = "";
  @Input() descripcion: string = "";
  @Input() ruta: string = "";
  @Input() color: string = "";
}
