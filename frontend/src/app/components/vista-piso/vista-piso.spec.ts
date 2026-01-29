import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaPiso } from './vista-piso';

describe('VistaPiso', () => {
  let component: VistaPiso;
  let fixture: ComponentFixture<VistaPiso>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [VistaPiso]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaPiso);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
