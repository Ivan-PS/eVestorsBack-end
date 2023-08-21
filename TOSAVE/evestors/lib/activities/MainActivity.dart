import 'package:evestors/Prefabs/CardPrefab.dart';
import 'package:evestors/Prefabs/FooterPrefab.dart';
import 'package:evestors/Prefabs/HeadrerPrefab.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Utils/AccessNavigator.dart';
import 'NewsDetailActivity.dart';

class MainActivity extends StatefulWidget {
  const MainActivity({super.key});

  @override
  State<MainActivity> createState() => MainActivityState();
}

class MainActivityState extends State<MainActivity> {
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  List<Widget> _newsList = [];
  String testText =
      "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from de Finibus Bonorum et Malorum by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.";
  String testImageUrl = "assets/images/default.jpg";
  @override
  Widget build(BuildContext context) {
    List<Widget> _registerPages = [
      CardPrefab.cradWithImageAndTextClickable(context, testImageUrl, testText,
          () {
        goTo(context, NewsDetailActivity());
      }),
      CardPrefab.cradWithImageAndTextClickable(context, testImageUrl, testText,
          () {
        goTo(context, NewsDetailActivity());
      }),
      CardPrefab.cradWithImageAndTextClickable(context, testImageUrl, testText,
          () {
        goTo(context, NewsDetailActivity());
      }),
      CardPrefab.cradWithImageAndTextClickable(context, testImageUrl, testText,
          () {
        goTo(context, NewsDetailActivity());
      })
    ];
    return Scaffold(
        body: Container(
      child: Column(
        children: [
          HeaderPrefab.defaultOnlyText(context, "Noticias"),
          Expanded(
            child: ListView.builder(
              shrinkWrap: true,
              itemBuilder: (context, position) {
                return _registerPages[position];
              },
              itemCount: _registerPages.length,
            ),
          ),
          FooterPrefab().defaultFooter(context, 0)
        ],
      ),
    ));
  }

  void goTo(BuildContext, Widget widgetToGo) {
    AccessNavigator.accessTo(context, widgetToGo);
  }
}
