import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/InputTextPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/FoldersActivity.dart';
import 'package:evestors/beans/FolderBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';
import '../Prefabs/ButtonPrefab.dart';
import '../Utils/AccessNavigator.dart';
import '../Utils/ResponseDecoder.dart';
import '../WebService/CheckResponse.dart';
import 'MainActivity.dart';

class AddFolderActivity extends StatefulWidget {
  final int startUpId;
  final String startUpName;
  const AddFolderActivity(
      {super.key, required this.startUpId, required this.startUpName});

  @override
  State<AddFolderActivity> createState() => AddFolderActivityState();
}

class AddFolderActivityState extends State<AddFolderActivity> {
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
            HeaderPrefab.defaultOnlyText(context, "Añadir Fichero"),
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
                                  addFolder(nameController.text,
                                      descriptionController.text);
                                },
                              ),
                            )),
                      ]),
                ),
              ),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            FooterPrefab().defaultFooter(context, 2)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }

  void addFolder(name, description) {
    addFolderToDb(name, description, "/", 0, widget.startUpId);
  }

  void addFolderToDb(name, description, path, parent, startUpId) async {
    ResponseDecoder responseDecoded = ResponseDecoder().decodeResponse(
        await FolderBean.createFolder(
            name, description, path, parent, startUpId));
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      if (context.mounted) {
        AccessNavigator.accessAndReplaceTo(
            context,
            FolderActivity(
                startUpId: startUpId, startUpName: widget.startUpName));
      }
    }
  }
}
