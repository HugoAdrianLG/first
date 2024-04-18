import { ComponentFixture, TestBed } from '@angular/core/testing';
import { AddmodalPage } from './addmodal.page';

describe('AddmodalPage', () => {
  let component: AddmodalPage;
  let fixture: ComponentFixture<AddmodalPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(AddmodalPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
