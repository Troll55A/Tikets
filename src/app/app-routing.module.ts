import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Index1Component } from './index1/index1.component';

const routes: Routes = [{
  path:'get/:variable',
  component:Index1Component
}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
