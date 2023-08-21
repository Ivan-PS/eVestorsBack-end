import 'package:evestors/Prefabs/ElementsPrefab.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../Prefabs/FooterPrefab.dart';
import '../../Prefabs/HeadrerPrefab.dart';

class DetailFolder extends StatefulWidget {
  final String title;
  int folderId;
  DetailFolder({super.key, required this.title, required this.folderId});

  @override
  State<DetailFolder> createState() => _DetailFolderState();
}

class _DetailFolderState extends State<DetailFolder> {
  List<Map<String, dynamic>> infoFolder = [{}];

  void didChangeDependencies() {
    super.didChangeDependencies();
    infoFolder = [
      {'title': "Title 1", "subTitle": "Sub Title 1"},
      {'title': "Title 1", "subTitle": "Sub Title 1"},
      {'title': "Title 1", "subTitle": "Sub Title 1"}
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Container(
      child: Column(
        children: [
          HeaderPrefab.defaultHeader(context, widget.title),
          ElementsPrefab().defualtFileElementList(infoFolder)
        ],
      ),
    ));
  }
}
