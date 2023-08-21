import 'package:evestors/Prefabs/ButtonPrefab.dart';
import 'package:evestors/Prefabs/InputTextPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/Utils/DefaultColors.dart';
import 'package:evestors/Utils/ResponseDecoder.dart';
import 'package:evestors/WebService/CheckResponse.dart';
import 'package:evestors/WebService/WebService.dart';
import 'package:evestors/activities/MainActivity.dart';
import 'package:evestors/activities/RegisterActivity.dart';
import 'package:evestors/activities/daos/UserDao.dart';
import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:evestors/activities/startUp/StartupInitialActivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Utils/Toast.dart';

class LoginActivity extends StatefulWidget {
  const LoginActivity({super.key});

  @override
  State<LoginActivity> createState() {
    return LoginActivityState();
  }
}

class LoginActivityState extends State<LoginActivity> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Container(
            child: Padding(
      padding: const EdgeInsets.all(8.0),
      child: Center(
        child: Container(
          child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                Padding(
                    padding: const EdgeInsets.all(8.0),
                    child:
                        TextPrefab.titleText(context, "Bienvenid@ a eVestors")),
                TextPrefab.subTitleText(context, "Ingresa tus credenciales"),
                Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: InputTextPrefab.defaultInputText(
                      "Email", emailController),
                ),
                Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: InputTextPrefab.defaultInputPasswordText(
                      "Contraseña", passwordController),
                ),
                Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: Container(
                      width: double.infinity,
                      child: ButtonPrefab.defaultButton(
                        "Entrar",
                        () {
                          login();
                        },
                      ),
                    )),
                Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Column(children: [
                    TextPrefab.defaultClickableTextSmall(context, "Rgistrate",
                        () {
                      goTo(context, RegisterActivity());
                    })
                  ]),
                ),
              ]),
        ),
      ),
    )));
  }

  static void goTo(BuildContext context, Widget widgetToGo) {
    AccessNavigator.accessTo(context, widgetToGo);
  }

  void login() async {
    String email = emailController.text;
    String password = passwordController.text;

    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await WebService().loginUser(email, password));
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      if (context.mounted) {
        UserDao user = UserDao.saveByJsonUser(responseDecoded.body["response"]);
        await user.saveToPrefrencesUser();
        AccessNavigator.accessTo(context, MainActivity());
      }
    } else {
      if (context.mounted) {
        Toast.showToast(
            context, DefaultColors.redDanger, "Error al inicar sesion");
      }
    }

    print(responseDecoded.toString());
  }
}
