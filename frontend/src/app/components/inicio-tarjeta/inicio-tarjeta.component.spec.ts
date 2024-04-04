import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InicioTarjetaComponent } from './inicio-tarjeta.component';

describe('InicioTarjetaComponent', () => {
  let component: InicioTarjetaComponent;
  let fixture: ComponentFixture<InicioTarjetaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [InicioTarjetaComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(InicioTarjetaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
