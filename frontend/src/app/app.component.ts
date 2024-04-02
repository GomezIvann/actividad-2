import { Component } from '@angular/core';
import { RouterLink, RouterOutlet } from '@angular/router';
import { CabeceraComponent } from './components/cabecera/cabecera.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CabeceraComponent, RouterLink, RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent {}
