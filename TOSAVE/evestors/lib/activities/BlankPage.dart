import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';

class BlankPageActivity extends StatefulWidget {
  const BlankPageActivity({super.key});

  @override
  State<BlankPageActivity> createState() => BlankPageActivityState();
}

class BlankPageActivityState extends State<BlankPageActivity> {
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
            HeaderPrefab.defaultOnlyText(context, "Blanco"),
            Container(
              child: Container(),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            Spacer(),
            FooterPrefab().defaultFooter(context, 1)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }
}
