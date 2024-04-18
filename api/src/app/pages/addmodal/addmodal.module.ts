import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AddmodalPageRoutingModule } from './addmodal-routing.module';

import { AddmodalPage } from './addmodal.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AddmodalPageRoutingModule
  ],
  declarations: [AddmodalPage]
})
export class AddmodalPageModule {}
