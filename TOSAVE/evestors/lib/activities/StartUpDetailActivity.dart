import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';

class StartUpDetailActivity extends StatefulWidget {
  final String title;
  final int startUpId;
  const StartUpDetailActivity(
      {super.key, required this.title, required this.startUpId});

  @override
  State<StartUpDetailActivity> createState() => StartUpDetailActivityState();
}

class StartUpDetailActivityState extends State<StartUpDetailActivity> {
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    Widget initlPage() {
      return Container(
        child: Column(
          children: [
            HeaderPrefab.defaultHeader(context, widget.title),
            Container(
              child: Container(),
            ),
            // ElementsPrefab().defaultElementWithImage(),
            Spacer(),
            FooterPrefab().defaultStartUpFooter(
                context, 0, widget.title, widget.startUpId)
          ],
        ),
      );
    }

    return Scaffold(body: initlPage());
  }
}
