import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { UpdatemodalPageRoutingModule } from './updatemodal-routing.module';

import { UpdatemodalPage } from './updatemodal.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    UpdatemodalPageRoutingModule
  ],
  declarations: [UpdatemodalPage]
})
export class UpdatemodalPageModule {}
