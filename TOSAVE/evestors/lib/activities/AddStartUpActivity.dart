import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/InputTextPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/FoldersActivity.dart';
import 'package:evestors/beans/FolderBean.dart';
import 'package:evestors/beans/StartUpBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';
import '../Prefabs/ButtonPrefab.dart';
import '../Utils/AccessNavigator.dart';
import '../Utils/ResponseDecoder.dart';
import '../WebService/CheckResponse.dart';
import 'MainActivity.dart';

class AddStartUpActivity extends StatefulWidget {
  const AddStartUpActivity({super.key});

  @override
  State<AddStartUpActivity> createState() => StartUpActivityState();
}

class StartUpActivityState extends State<AddStartUpActivity> {
  @override
  final nameController = TextEditingController();
  final descriptionController = TextEditingController();
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
            HeaderPrefab.defaultOnlyText(context, "Añadir StartUp"),
            Expanded(
              child: Center(
                child: Container(
                  child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: InputTextPrefab.defaultInputText(
                              "Nombre", nameController),
                        ),
                        Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: InputTextPrefab.defaultInputMultiLineText(
                              "Descripcion", descriptionController),
                        ),
                        Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Container(
                              width: double.infinity,
                              child: ButtonPrefab.defaultButton(
                                "Añadir",
                                () {
                                  addStartUp(nameController.text,
                                      descriptionController.text);
                                },
                              ),
                            )),
                      ]),
                ),
              ),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            FooterPrefab().defaultFooter(context, 3)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }

  void addStartUp(name, description) {
    addFolderToDb(name, description);
  }

  void addFolderToDb(name, description) async {
    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await StartUpBean.createStartUp(name, description));
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      if (context.mounted) {
        AccessNavigator.accessAndReplaceTo(context, const MainActivity());
      }
    }
  }
}
