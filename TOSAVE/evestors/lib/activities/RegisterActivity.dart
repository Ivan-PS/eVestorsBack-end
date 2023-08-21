import 'package:evestors/Prefabs/HeadrerPrefab.dart';
import 'package:evestors/Utils/ResponseDecoder.dart';
import 'package:evestors/WebService/CheckResponse.dart';
import 'package:evestors/beans/UserBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Prefabs/ButtonPrefab.dart';
import '../Prefabs/InputTextPrefab.dart';
import '../Prefabs/TextPrefab.dart';
import '../Utils/AccessNavigator.dart';
import 'MainActivity.dart';

class RegisterActivity extends StatefulWidget {
  const RegisterActivity({super.key});

  @override
  State<RegisterActivity> createState() {
    return MainActivityState();
  }
}

class MainActivityState extends State<RegisterActivity> {
  late BuildContext context;
  int type = 0;
  final mailController = TextEditingController();
  final passwordController = TextEditingController();
  final nameController = TextEditingController();
  final firstNameController = TextEditingController();
  final secondNameController = TextEditingController();

  @override
  void initState() {
    super.initState();
  }

  List<Widget> _registerPages = [];
  int _actuatPageIndex = 0;

  @override
  Widget build(BuildContext context) {
    Widget credentialsFirst(BuildContext context) {
      return Container(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: TextPrefab.titleText(context, "Crea tu cuenta")),
              TextPrefab.subTitleText(context, "Esto va a ser rapido"),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: InputTextPrefab.defaultInputText(
                    "Correo electronico", mailController),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: InputTextPrefab.defaultInputPasswordText(
                    "Password", passwordController),
              ),
              Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Container(
                    width: double.infinity,
                    child: ButtonPrefab.defaultButton(
                      "Continua",
                      () {
                        setState(() {
                          _actuatPageIndex = 1;
                        });
                      },
                    ),
                  ))
            ]),
      );
    }

    Widget credentialsSecond(BuildContext context) {
      return Container(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: TextPrefab.titleText(context, "¿Quien Eres?")),
              TextPrefab.subTitleText(context, "Tenemos que saber mas de ti"),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child:
                    InputTextPrefab.defaultInputText("Nombre", nameController),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: InputTextPrefab.defaultInputText(
                    "Primer Apellido", firstNameController),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: InputTextPrefab.defaultInputText(
                    "Segundo Apellido", secondNameController),
              ),
              Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Container(
                    width: double.infinity,
                    child: ButtonPrefab.defaultButton(
                      "Continua",
                      () {
                        getUserAndRegister(context);
                      },
                    ),
                  ))
            ]),
      );
    }

    Widget credentialsThird(BuildContext context) {
      return Center(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: TextPrefab.titleText(context, "Te registras como")),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: SizedBox(
                    width: 240,
                    child: ButtonPrefab.defaultRoundButton("Start-Up", () {
                      getUserAndRegister(context);
                    })),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: SizedBox(
                    width: 240,
                    child: ButtonPrefab.defaultRoundButton("Inversor", () {
                      getUserAndRegister(context);
                    })),
              ),
            ]),
      );
    }

    void changeRegisterPage(int toPage) {
      setState(() {
        _actuatPageIndex = toPage;
      });
    }

    _registerPages = [
      credentialsFirst(context),
      credentialsSecond(context),
      // credentialsThird(context)
    ];

    return Scaffold(
        body: Column(children: [
      Expanded(
          child: SingleChildScrollView(
              child: Column(children: [
        Container(
            margin: const EdgeInsets.only(bottom: 96.0),
            child: HeaderPrefab.defaultHeaderNoTextNoBorder(context)),
        Container(child: _registerPages[_actuatPageIndex])
      ])))
    ]));
  }

  static void goTo(BuildContext context, Widget widgetToGo) {
    AccessNavigator.accessTo(context, widgetToGo);
  }

  void getUserAndRegister(context) {
    String name = nameController.text;
    String email = mailController.text;
    String password = passwordController.text;
    String firstName = firstNameController.text;
    String secondName = secondNameController.text;
    registerUser(context, name, email, password, firstName, secondName);
  }

  static void registerUser(BuildContext context, String name, String email,
      String password, String firstName, String secondName) async {
    ResponseDecoder responseDecoded = ResponseDecoder().decodeResponse(
        await UserBean.registerUser(
            name, email, password, firstName, secondName, 0));
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      if (context.mounted) {
        AccessNavigator.accessAndReplaceTo(context, const MainActivity());
      }
    }
  }
}
