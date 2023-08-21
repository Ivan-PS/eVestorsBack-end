import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';

class StartupInitialActivity extends StatefulWidget {
  const StartupInitialActivity({super.key});

  @override
  State<StartupInitialActivity> createState() => StartupInitialState();
}

class StartupInitialState extends State<StartupInitialActivity> {
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
            HeaderPrefab.defaultOnlyText(context, "Archivos"),
            Container(
              child: Container(),
            ),
            Spacer(),
            FooterPrefab().defaultFooter(context, 1)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }
}
