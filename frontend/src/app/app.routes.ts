import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { TiendasComponent } from './components/tiendas/tiendas.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { DetallesTiendaComponent } from './components/detalles-tienda/detalles-tienda.component';

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
  },
  {
    path: 'detalles-tienda/:id',
    component: DetallesTiendaComponent,
    title: 'Detalles de la tienda',
  },
];
