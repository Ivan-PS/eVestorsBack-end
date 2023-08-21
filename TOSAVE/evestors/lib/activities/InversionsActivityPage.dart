import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/DefaultColors.dart';
import 'package:evestors/WebService/CheckResponse.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';
import '../Prefabs/ButtonPrefab.dart';
import '../Utils/ResponseDecoder.dart';
import '../WebService/WebService.dart';

class InversionsActivityPage extends StatefulWidget {
  const InversionsActivityPage({super.key});

  @override
  State<InversionsActivityPage> createState() => InversionsActivityPageState();
}

class InversionsActivityPageState extends State<InversionsActivityPage> {
  final TextEditingController _textFieldController = TextEditingController();
  String textError = "";
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    Widget initlPage() {
      String testText = "";
      return Container(
        child: Column(
          children: [
            HeaderPrefab.defaultOnlyText(context, "Inversiones"),
            Container(
              child: Container(),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            Spacer(),

            Padding(
                padding: const EdgeInsets.all(8.0),
                child: Container(
                  width: double.infinity,
                  child: ButtonPrefab.defaultButton(
                    "Unirse a una StartUp",
                    () {
                      _showInputDialog(context);
                    },
                  ),
                )),
            FooterPrefab().defaultFooter(context, 4)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }

  Future<void> _showInputDialog(BuildContext context) async {
    return showDialog(
        context: context,
        builder: (context) {
          return AlertDialog(
            title: const Text('Introduce codigo de accesso'),
            content: Column(mainAxisSize: MainAxisSize.min, children: [
              TextField(
                keyboardType: TextInputType.number,
                controller: _textFieldController,
                decoration:
                    const InputDecoration(hintText: "Codigo de accesso"),
              ),
              Text(
                textError,
                textAlign: TextAlign.center,
                style: TextStyle(color: DefaultColors.redDanger),
              )
            ]),
            actions: <Widget>[
              MaterialButton(
                color: DefaultColors.redDanger,
                textColor: Colors.white,
                child: const Text('Cancelar'),
                onPressed: () {
                  setState(() {
                    Navigator.pop(context);
                  });
                },
              ),
              MaterialButton(
                color: DefaultColors.primary,
                textColor: Colors.white,
                child: const Text('OK'),
                onPressed: () {
                  setState(() {
                    checkAccessCode();
                    // Navigator.pop(context);
                  });
                },
              ),
            ],
          );
        });
  }

  checkAccessCode() async {
    String accessCode = _textFieldController.text;
    int userId = await LocalPreferences().getUserId();
    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await WebService().checkAccessCode(userId, accessCode));
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      print("CHECK ACCESS CODE");
      print(responseDecoded.body.toString());
      Navigator.pop(context);
    } else {
      setState(() {
        textError = "ERROR CON EL CODIGO DE ACCESSO";
      });
    }
  }
}
