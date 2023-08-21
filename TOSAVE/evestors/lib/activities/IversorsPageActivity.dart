import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/WebService/WebService.dart';
import 'package:evestors/activities/AddStartUpActivity.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/daos/StartUpDao.dart';
import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:evestors/beans/StartUpBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';
import '../Prefabs/ButtonPrefab.dart';
import '../Utils/ResponseDecoder.dart';
import '../WebService/CheckResponse.dart';
import '../beans/FolderBean.dart';

class InversorsPageActivity extends StatefulWidget {
  final int startUpId;
  final String startUpName;
  const InversorsPageActivity(
      {super.key, required this.startUpId, required this.startUpName});

  @override
  State<InversorsPageActivity> createState() => InversorsPageActivityState();
}

class InversorsPageActivityState extends State<InversorsPageActivity> {
  Widget inversorsElements = Spacer();
  int accessCode = 0;

  void didChangeDependencies() async {
    super.didChangeDependencies();

    accessCode = await getAccessCode();

    List<StartUpDao> startUpAllowed = []; //  await getStartUpsAllowed();

    setState(() {
      startUpAllowed.isNotEmpty
          ? inversorsElements = ElementsPrefab()
              .defaultElementWithImageStartUpList(startUpAllowed)
          : inversorsElements = const Spacer();
    });
  }

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
            HeaderPrefab.defaultOnlyText(context, "Inversores"),
            Container(
              child: Container(),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            inversorsElements,
            Spacer(),
            Padding(
                padding: const EdgeInsets.all(8.0),
                child: Container(
                  width: double.infinity,
                  child: accessCode == 0
                      ? ButtonPrefab.defaultButton(
                          "Añadir Inversores",
                          () {
                            _showInputDialog(context);
                          },
                        )
                      : ButtonPrefab.defaultButton(
                          "Codigo de Accesso: ${accessCode.toString()}",
                          () {},
                        ),
                )),
            FooterPrefab().defaultStartUpFooter(
                context, 2, widget.startUpName, widget.startUpId)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }

  static Future<List<StartUpDao>> getInversorsAllowed() async {
    int idUser = await LocalPreferences().getUserId();

    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await StartUpBean.getAllStartUpsAllowed(idUser));
    print(responseDecoded.body);
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      return StartUpDao.getByJsonList(responseDecoded.body["response"]);
    }
    return [];
  }

  void _showInputDialog(BuildContext context) {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Generar Codigo de accesso?'),
            content: Text('Quieres generar un codigo de accesso?'),
            actions: <Widget>[
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                  generarateAccessCode();
                },
                child: Text('Generar'),
              ),
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: Text('Cerrar'),
              ),
            ],
          );
        });
  }

  void _showInputDialogAccessCode(int accessCode) {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Codigo de Acceso'),
            content: Text('El codigo de accesso es: ${accessCode.toString()}'),
            actions: <Widget>[
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: Text('Cerrar'),
              ),
            ],
          );
        });
  }

  generarateAccessCode() async {
    ResponseDecoder responseDecoded = ResponseDecoder().decodeResponse(
        await WebService().genereateAccessCode(widget.startUpId));

    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      print(responseDecoded.body.toString());
      _showInputDialogAccessCode(
          responseDecoded.body['response']['accessCode']);
      setState(() {
        accessCode = responseDecoded.body['response']['accessCode'];
      });
    }
  }

  Future<int> getAccessCode() async {
    int accessCode = 0;
    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await WebService().getAccessCode(widget.startUpId));

    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      print(responseDecoded.body.toString());
      accessCode = responseDecoded.body['response']['accessCode'];
    }
    return accessCode;
  }
}
