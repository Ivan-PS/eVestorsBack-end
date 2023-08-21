import 'package:flutter/material.dart';

class DialogPrefab {
  void showAddFolderDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (_) {
        var emailController = TextEditingController();
        var messageController = TextEditingController();
        return AlertDialog(
          title: Text('Contact Us'),
          content: ListView(
            shrinkWrap: true,
            children: [
              TextFormField(
                controller: emailController,
                decoration: InputDecoration(hintText: 'Nombre'),
              ),
              TextFormField(
                controller: messageController,
                decoration: InputDecoration(hintText: 'Descripcion'),
              ),
            ],
          ),
          actions: [
            TextButton(
              onPressed: () {},
              child: Text('Cancel'),
            ),
            TextButton(
              onPressed: () {
                // Send them to your email maybe?
                var email = emailController.text;
                var message = messageController.text;
              },
              child: Text('Send'),
            ),
          ],
        );
      },
    );
  }

  void showTestAddFolderDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (_) {
        var emailController = TextEditingController();
        var messageController = TextEditingController();
        return AlertDialog(
          title: Text('Contact Us'),
        );
      },
    );
  }
}
