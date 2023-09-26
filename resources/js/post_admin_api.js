export function getDataPost(idPost) {
  return new Promise((resolve) => {
    fetch('/api/V1/post/'+idPost)
      .then(response => {
        if (response.status == 200) return response.json()
      })
      .then((data) => resolve(data))
    return true
  })
}

export function getDataCategory(idCategory) {
  return new Promise((resolve) => {
    fetch('/api/V1/post-category/'+idCategory)
      .then(response => {
        if (response.status == 200) return response.json()
      })
      .then((data) => resolve(data));

    return true
  })
}