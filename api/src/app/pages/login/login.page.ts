import { Component, OnInit } from '@angular/core';
import { AlertController } from '@ionic/angular';
import { AngularFireAuth } from '@angular/fire/compat/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  email: string = '';
  password: string = '';

  constructor( private alertController: AlertController, private afAuth: AngularFireAuth, private router:Router) { }

  ngOnInit() {
  }

  async login() {
    try {
      const userCredential = await this.afAuth.signInWithEmailAndPassword(
        this.email,
        this.password
      );
      // Inicio de sesión exitoso, puedes redirigir a otra página o mostrar un mensaje
      this.presentAlert('¡Inicio de sesión exitoso!');
      this.router.navigateByUrl('')
    } catch (error) {
      // Error al iniciar sesión, muestra un mensaje de error
      this.presentAlert('Credenciales incorrectas. Inténtalo de nuevo.');
    }

  }

  goToRegister() {
    // Redirige al usuario a la página de registro al hacer clic en el enlace
    this.router.navigateByUrl('/registro');
  }

  async presentAlert(message: string) {
    const alert = await this.alertController.create({
      header: 'Alerta',
      message: message,
      buttons: ['OK'],
    });

    await alert.present();
  }
}




