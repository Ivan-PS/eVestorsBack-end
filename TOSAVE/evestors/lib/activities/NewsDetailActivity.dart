import 'package:evestors/Prefabs/CardPrefab.dart';
import 'package:evestors/Prefabs/HeadrerPrefab.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class NewsDetailActivity extends StatefulWidget {
  const NewsDetailActivity({super.key});

  @override
  State<NewsDetailActivity> createState() => NewsDetailActivityState();
}

class NewsDetailActivityState extends State<NewsDetailActivity> {
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
    Widget card =
        CardPrefab.cradWithImageAndText(context, testImageUrl, testText);

    return Scaffold(
        body: Container(
      child: Column(
        children: [
          HeaderPrefab.defaultHeader(context, "Noticia 01"),
          Expanded(child: card),
        ],
      ),
    ));
  }
}
