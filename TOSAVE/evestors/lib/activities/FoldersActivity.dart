import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/Utils/DefaultColors.dart';
import 'package:evestors/activities/AddFolderActivity.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:evestors/activities/startUp/DetailFolderActivity.dart';
import 'package:evestors/beans/FolderBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Prefabs/DialogPrefab.dart';
import '../Prefabs/FooterPrefab.dart';
import '../Prefabs/HeadrerPrefab.dart';
import '../Utils/ResponseDecoder.dart';
import '../WebService/CheckResponse.dart';
import 'daos/FolderDao.dart';

class FolderActivity extends StatefulWidget {
  final int startUpId;
  final String startUpName;
  const FolderActivity(
      {super.key, required this.startUpId, required this.startUpName});

  @override
  State<FolderActivity> createState() => FolderState();
}

class FolderState extends State<FolderActivity> {
  List<Widget> folderElements = [];
  @override
  void didChangeDependencies() async {
    List<Widget> newFolderElements = [];
    super.didChangeDependencies();
    List<FolderDao> folders = await getFoldersAllowed(0, widget.startUpId);
    folders.forEach((element) {
      newFolderElements.add(IconsPrefab()
          .iconWithTextAction(context, Icons.folder, element.name, () {
        AccessNavigator.accessTo(
            context, DetailFolder(title: element.name, folderId: element.id));
      }));
    });
    setState(() {
      folderElements = newFolderElements;
    });
  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  static Future<List<FolderDao>> getFoldersAllowed(
      int parent, int startUpId) async {
    int idUser = await LocalPreferences().getUserId();

    ResponseDecoder responseDecoded = ResponseDecoder().decodeResponse(
        await FolderBean.getFoldersAllowed(idUser, parent, startUpId));
    print(responseDecoded.body);
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      return FolderDao.getByJsonList(responseDecoded.body["response"]);
    }
    return [];
  }

  @override
  Widget build(BuildContext context) {
    Widget initlPage() {
      String testText = "";
      return Container(
        child: Column(
          children: [
            HeaderPrefab.defaultOnlyText(context, "Archivos"),
            Expanded(
                child: Container(
              child: GridView.count(
                crossAxisCount: 2,
                children: folderElements,
              ),
            )),
            widget.startUpId == 0
                ? FooterPrefab().defaultFooter(context, 2)
                : FooterPrefab().defaultStartUpFooter(
                    context, 1, widget.startUpName, widget.startUpId)
          ],
        ),
      );
    }

    return Scaffold(
      body: initlPage(),
      floatingActionButton: Padding(
        padding: const EdgeInsets.only(bottom: 64),
        child: FloatingActionButton(
          onPressed: () {
            AccessNavigator.accessTo(
                context,
                AddFolderActivity(
                  startUpId: widget.startUpId,
                  startUpName: widget.startUpName,
                ));
          },
          backgroundColor: DefaultColors.primary,
          child: const Icon(Icons.add),
        ),
      ),
    );
  }
}
