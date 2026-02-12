import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HeaderPropietario } from './header-propietario';

describe('HeaderPropietario', () => {
  let component: HeaderPropietario;
  let fixture: ComponentFixture<HeaderPropietario>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [HeaderPropietario]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HeaderPropietario);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
