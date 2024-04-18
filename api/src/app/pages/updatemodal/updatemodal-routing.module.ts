import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { UpdatemodalPage } from './updatemodal.page';

const routes: Routes = [
  {
    path: '',
    component: UpdatemodalPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class UpdatemodalPageRoutingModule {}
