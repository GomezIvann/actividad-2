import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { TiendasComponent } from './components/tiendas/tiendas.component';
import { ContactoComponent } from './components/contacto/contacto.component';

export const routes: Routes = [
  {
    path: '',
    component: InicioComponent,
    title: 'Inicio',
  },
  {
    path: 'inicio',
    component: InicioComponent,
    title: 'Inicio',
  },
  {
    path: 'tiendas',
    component: TiendasComponent,
    title: 'Tiendas',
  },
  {
    path: 'contacto',
    component: ContactoComponent,
    title: 'Contacto',
  }
];
