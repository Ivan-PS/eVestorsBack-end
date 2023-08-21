import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
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

class StartUpsPageActivity extends StatefulWidget {
  const StartUpsPageActivity({super.key});

  @override
  State<StartUpsPageActivity> createState() => StartUpsPageActivityState();
}

class StartUpsPageActivityState extends State<StartUpsPageActivity> {
  Widget startUpElements = Spacer();
  void didChangeDependencies() async {
    super.didChangeDependencies();
    List<StartUpDao> startUpAllowed = await getStartUpsAllowed();

    setState(() {
      startUpAllowed.isNotEmpty
          ? startUpElements = ElementsPrefab()
              .defaultElementWithImageStartUpList(startUpAllowed)
          : startUpElements = const Spacer();
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
            HeaderPrefab.defaultOnlyText(context, "StartUps"),
            Container(
              child: Container(),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            startUpElements,
            Spacer(),
            Padding(
                padding: const EdgeInsets.all(8.0),
                child: Container(
                  width: double.infinity,
                  child: ButtonPrefab.defaultButton(
                    "Añadir StartUp",
                    () {
                      AccessNavigator.accessTo(context, AddStartUpActivity());
                    },
                  ),
                )),
            FooterPrefab().defaultFooter(context, 3)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }

  static Future<List<StartUpDao>> getStartUpsAllowed() async {
    int idUser = await LocalPreferences().getUserId();

    ResponseDecoder responseDecoded = ResponseDecoder()
        .decodeResponse(await StartUpBean.getAllStartUpsAllowed(idUser));
    print(responseDecoded.body);
    if (CheckResponse.isOkResponse(responseDecoded.status)) {
      return StartUpDao.getByJsonList(responseDecoded.body["response"]);
    }
    return [];
  }
}
