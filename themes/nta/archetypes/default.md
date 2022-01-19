---
title: "{{ replace .Name "-" " " | title }}"
draft: true
menu:
    main:
        identifier: "{{ lower (replace .Name "-" "")  }}"
        name: "{{ replace .Name "-" " " | title }}"
        weight: 100 
        parent: ""
---

# {{ .Name | title }}